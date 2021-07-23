const isProd = () => {
    return process.env.NODE_ENV === 'production'
}

const baseUrl = () => {
    if(isProd()) {
        return window.location.protocol + '//' + window.location.hostname
    }
    return process.env.VUE_APP_URL
}

export {
    isProd,
    baseUrl
}
