appCategoryStub = {
        target: 34,
        blocked: false,
        title: 'Category',
        parameters: [],
        isCategoriesGroup: false
    }

appCategory = (data, count = 1) => {
    if(count == 1)
        return _.extend(appCategoryStub, data)

    var appCategories = [];

    for (var i = 0; i < count; i++) {
        appCategories.push(_.extend(appCategoryStub, data))
    }

    return appCategories
}