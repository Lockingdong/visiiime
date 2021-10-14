const isProd = () => {
    return process.env.NODE_ENV === 'production'
}

const baseUrl = () => {
    if(isProd()) {
        return window.location.protocol + '//' + window.location.hostname
    }
    return process.env.VUE_APP_URL
}

const csrfToken = () => {
    if(document.querySelector('meta[name="csrf-token"]') === null) {
        return null;
    }
    return document.querySelector('meta[name="csrf-token"]').content;
}

export {
    isProd,
    baseUrl,
    csrfToken
}
