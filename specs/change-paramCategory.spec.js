import changeParamCategory from '../resources/assets/js/components/change-paramCategory'

describe('change-paramCategory Component', () => {
  beforeEach(() => {
    window.specComponent = changeParamCategory
    EventBus.clearHistory()
  })

  it('can update categories', () => {
    createVue()
    then(() => {
      vm.parameter = TestData.categorized_parameters[0]

      expect(typeof vm.updateCategories).toBe('function')

      vm.updateCategories(appCategory({}, 4))
    })
    .then(() => {
      expect(vm.categories.length)
      .toBe(4)
    })
  })

  it('mount the given categories', () => {
    createVue()

    vm.parameter = TestData.categorized_parameters[0]

    setUpCategories()

    then(() => {
      TestData.categories.forEach((_category) => {
        expect(vm.$el.textContent)
        .toContain(_category.value)
      })
    })
  })

  it('register the correct events', () => {
    var listenEventsLength = EventBus.getListenHistory().length

    createVue()

    then(() => {
      ['update-categories',
      'changed-paramCategory',
      'start-addCategory',
      'end-addCategory']
      .forEach((event) => {
        expectListenEvent(event)
      })
    })

    expect(EventBus.getListenHistory().length)
    .toBeGreaterThan(listenEventsLength + 3)
  })

  it('check if parameter belongs to category', () => {
    // arrange
    createVue()

    setUpCategories()

    // act
    vm.parameter = TestData.categorized_parameters[0]

    var selectedParameterCategory = getParameterCategory()

    // assert
    
    then(() => {
      vm.categories.forEach((_category) => {
        expect(vm.paramBelongsToCategory(_category))
        .toBe( selectedParameterCategory.target == _category.target )
      })
  
      //   validate test data
      expect(typeof selectedParameterCategory)
      .toBe('object')
      expect(vm.categories.length)
      .toBeGreaterThan(2)
    })
  })

  it(`do nothing if parameter's category is chosen`, () => {
    // arrange
    createVue()

    setUpCategories()

    vm.parameter = TestData.categorized_parameters[0]

    var selectedParameterCategory = getParameterCategory()

    // act
    var choseCategory = vm.choseCategory(selectedParameterCategory)

    // assert
    then(() => {

      expect(choseCategory)
      .toBeNull()

      expect(EventBus.getFireHistory().length)
      .toBe(0)
    })
  })

  it('alert and stop if category is chosen while busy', () => {
    // arrange
    createVue()

    setUpCategories()

    vm.parameter = TestData.categorized_parameters[0]
    vm.isBusy = true

    // act
    then(() => {
      vm.choseCategory(TestData.categories[0])
    })

    // assert
    .then(() => {
      expect(vm.notificationStore.state.length)
      .toBe(1)
      expect(vm.notificationStore.state[0].message)
      .toBe('Wait until the previous request processed..')

      expect(EventBus.getFireHistory().length)
      .toBe(0)
    })
  })
})


var getParameterCategory = () => {
  return _.find(vm.categories,
  (_category) => {
      return _category.target == vm.parameter.category_id
  })
}