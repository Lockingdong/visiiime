import axios from "axios";
import { isProd } from '../env';

const providers = [
    {
        provider_name: "YouTube",
        provider_url: "https://www.youtube.com/",
        endpoints: [
            {
                schemes: [
                    "https://*.youtube.com/watch*",
                    "https://*.youtube.com/v/*",
                    "https://youtu.be/*",
                    "https://*.youtube.com/playlist?list=*"
                ],
                url: "https://www.youtube.com/oembed",
                discovery: true
            }
        ]
    },
    {
        provider_name: "Spotify",
        provider_url: "https://spotify.com/",
        endpoints: [
            {
                schemes: ["https://*.spotify.com/*", "spotify:*"],
                url: "https://embed.spotify.com/oembed/",
            },
        ],
    },
    {
        provider_name: "SoundCloud",
        provider_url: "http://soundcloud.com/",
        endpoints: [
            {
                schemes: ["http://soundcloud.com/*", "https://soundcloud.com/*", "https://soundcloud.app.goog.gl/*"],
                url: "https://soundcloud.com/oembed",
            },
        ],
    },
];
const findProvider = (url, providers) => {
    const candidates = providers.filter((provider) => {
        const { schemes, domain } = provider;
        if (!schemes.length) {
            return url.includes(domain);
        }
        return schemes.some((scheme) => {
            const reg = new RegExp(scheme.replace(/\*/g, "(.*)"), "i");
            return url.match(reg);
        });
    });

    return candidates.length > 0 ? candidates[0] : null;
};

const getHostname = (url) => {
    const match = url.match(/:\/\/(www[0-9]?\.)?(.[^/:]+)/i);
    if (match && match.length > 2 && typeof match[2] === "string" && match[2].length > 0) {
        return match[2];
    }
    return null;
};

const providersFromList = (list) => {
    return list
        .map((item) => {
            const {
                provider_name, // eslint-disable-line camelcase
                provider_url, // eslint-disable-line camelcase
                endpoints,
            } = item;

            const endpoint = endpoints[0];
            const { schemes = [], url } = endpoint;

            const hostname = getHostname(url);
            const domain = hostname ? hostname.replace("www.", "") : "";

            return {
                provider_name, // eslint-disable-line camelcase
                provider_url, // eslint-disable-line camelcase
                schemes,
                domain,
                url,
            };
        })
        .filter((item) => {
            return item.domain !== "";
        });
};

const getRegularUrl = (query, basseUrl) => {
    return basseUrl.replace(/\{format\}/g, "json") + "?" + query;
};

const fetchEmbed = (url, provider, params = {}) => {
    const {
        provider_name, // eslint-disable-line camelcase
        provider_url, // eslint-disable-line camelcase
    } = provider;

    const queries = ["format=json", `url=${encodeURIComponent(url)}`];

    const { maxwidth = 0, maxheight = 0 } = params;

    if (maxwidth > 0) {
        queries.push(`maxwidth=${maxwidth}`);
    }
    if (maxheight > 0) {
        queries.push(`maxheight=${maxheight}`);
    }

    const query = queries.join("&");

    const link = getRegularUrl(query, provider.url);

    return {
        link,
        provider_name,
        provider_url
    };
};

const getOembedByUrl = async(url) => {
    try {
        let provider = findProvider(url, providersFromList(providers));
        if(provider === null) {
            throw 'provider not found'
        }
        const {link, provider_name, provider_url} = fetchEmbed(url, provider);

        let proxyUrl = isProd() ? window.WINDOW_PROXY_URL : process.env.VUE_APP_PROXY_URL;

        let { data } = await axios.get(proxyUrl + '/' + encodeURIComponent(url), {mode: 'no-cors'})

        if(data.status === 'fail') {
            throw 'fetch ' + url + ' fail'
        }

        data.provider_name = provider_name;

        data.provider_url = provider_url;

        return data;
    } catch (err) {
        // console.trace(err);
        console.log(err);
        return null;
    }
};

export { getOembedByUrl };
