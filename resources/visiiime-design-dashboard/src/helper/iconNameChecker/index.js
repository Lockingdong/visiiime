const checkIsIcon = (iconName) => {

    if(['', null].includes(iconName)) {
        return false
    }

    let iconNameArr = iconName.split('-');

    if(['cb', 'sb', 'sr', 'lb', 'lr'].includes(iconNameArr[0])) {
        return true
    }

    return false
}

export {
    checkIsIcon
}