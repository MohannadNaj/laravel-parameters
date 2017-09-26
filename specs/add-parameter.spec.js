import addParameter from '../resources/assets/js/components/add-parameter'

describe('add-parameter Component', () => {
  beforeEach(() => {
    if (vm) vm.$destroy()

    moxios.install()
    window.specComponent = addParameter
    EventBus.clearHistory()
    if (vm) vm.notificationStore.state = []
  })

  afterEach(function () {
    moxios.uninstall()
  })


  it(`load and list parameters types`, () => {
    // arrange
    createVue()

    // assert
    expect(vm.parametersTypes.length)
    .toBeGreaterThan(4)

    then(() => {
      vm.parametersTypes.forEach((type)=> {
        expect(vm.$el.textContent).toContain(type)
      })
    })
  })

  it(`output error text on invalid data`, (done) => {
    // arrange
    createVue()

    // act
    submitFailedRequest({
      label:['The label field is required.'],
      name: ['first validation error.','second validation error']})

    // assert
    .then(() => {
      expect(vm.$el.textContent)
      .toContain('The label field is required')

      expect(vm.$el.textContent)
      .toContain('first validation')
      
      expect(vm.$el.textContent)
      .toContain('second validation')
      done()
    })
  })

  it(`notify user on invalid data`, (done) => {
    // arrange
    createVue()

    // act
    submitFailedRequest()

    // assert
    .then(() => {
      expect(vm.notificationStore.state.length).toBe(1)
      done()
    })
  })

  it('listen to the correct events', () => {
    var listenEventsLength = EventBus.getListenHistory().length

    createVue()

    then(() => {
      ;[
        'opening-category'
      ].forEach(event => {
        expectListenEvent(event)
      })
    })

    expect(EventBus.getListenHistory().length)
    .toBeGreaterThanOrEqual(
      listenEventsLength + 1
    )
  })
})

var submitFailedRequest = (response) => {
  moxios.stubRequest(window.Laravel.base_url + 'parameters', {
    status: 422,
    response: response})

  vm.submit()

  return {
    then: (callback) => {
      then(() => {
        moxios.wait(() => {
          callback()
        })
      })
    }
  }
}