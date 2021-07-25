import { extend } from "vee-validate";

extend("youtubeUrl", {
    validate(value) {
        if (value) {
            return /(?:youtube\.com\/\S*(?:(?:\/e(?:mbed))?\/|watch\?(?:\S*?&?v=))|youtu\.be\/)([a-zA-Z0-9_-]{6,11})/.test(value);
        }

        return false;
    },
    message: "youtube網址格式錯誤",
});

extend("spotifyUrl", {
    validate(value) {
        if (value) {
            return /(https:\/\/open.spotify.com\/(track|user|artist|album|show)\/[a-zA-Z0-9]+(\/playlist\/[a-zA-Z0-9]+|)|spotify:(track|user|artist|album):[a-zA-Z0-9]+(:playlist:[a-zA-Z0-9]+|))/.test(value);
        }

        return false;
    },
    message: "spotify網址格式錯誤",
});

extend("applePUrl", {
    validate(value) {
        if (value) {
            return /https:\/\/?(podcasts|itunes).apple.com\/?/.test(value);
        }

        return false;
    },
    message: "apple podcast 網址格式錯誤",
});

extend("soundCldUrl", {
    validate(value) {
        if (value) {
            return /https:\/\/\/?soundcloud.com\/?/.test(value);
        }
        return false;
    },
    message: "soundcloud 網址格式錯誤",
});
