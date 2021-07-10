const isProd = () => {
    return process.env.NODE_ENV === 'production'
}

const baseUrl = () => {
    return process.env.VUE_APP_URL
}

export {
    isProd,
    baseUrl
}
