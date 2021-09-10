import {
    extract
} from 'oembed-parser';

const getOembedByUrl = async (url) => {
    try {
        const oembed = await extract(url);
        return oembed;
    } catch (err) {
        console.trace(err);
        return null
    }
};

export {
    getOembedByUrl
}
