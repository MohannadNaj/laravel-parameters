import addCategory from '../resources/assets/js/components/add-category'

describe('add-category Component', () => {
  beforeEach(() => {
    if (window.vm) window.vm.$destroy()

    moxios.install()
    window.specComponent = addCategory
    window.sinonSandbox = sinon.createSandbox()
    if (window.vm) window.vm.notificationStore.state = []
  })

  afterEach(() => {
    moxios.uninstall()
    sinonSandbox.restore()
    EventBus.clearHistory()
  })

  it(`validate category name before submit`, (done) => {
    // arrange
    createVue()


    // act
    vm.newCategoryName = ''
    let submit = vm.submit()

    // assert
    expect(submit)
    .toBe(null)

    then(() => {
      expect(vm.$el.querySelector('.addCategory--button__submit').disabled)
      .toBe(true)

      notExpectEvent('start-addCategory')

      expect(vm.validCategoryName)
      .toBe(false)
      done()
    })
  })

  it(`failed request: notify the user about the error`, (done) => {
    // arrange
    createVue()
    vm.newCategoryName = 'new category'
    // act
    submitFailedRequest("...",'parameters/addCategory')
    // assert
    then(() => {
      expect( window.vm.notificationStore.state.length )
      .toBe(1)
      //console.log('here')
      done()
    })
  })

  it(`failed request: register event`, (done) => {
    // arrange
    createVue()
    vm.newCategoryName = 'new category'
    // act
    submitFailedRequest("...",'parameters/addCategory')
    // assert
    then(() => {
      expectListenEvent('end-addCategory')
//      console.log('here')
      done()
    })
  })
})
/*
  it(`output error text on invalid data`, (done) => {
    // arrange
    createVue()

    // act
    vm.newCategoryName = 'New Category'

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

/*  it(`notify user on invalid data`, (done) => {
    // arrange
    createVue()

    // act
    submitFailedRequest()

    // assert
    .then(() => {
      expect(vm.notificationStore.state.length)
      .toBe(1)
      expect(vm.notificationStore.state[0].message)
      .toContain('Error')
      done()
    })
  })

  it(`notify user on token exception expiration`, (done) => {
    // arrange
    createVue()

    // act
    submitFailedRequest('TokenMismatchException')

    // assert
    .then(() => {

      expect(vm.notificationStore.state[0].message)
      .toContain('token mismatch')
      done()
    })
  })

  it(`attach category_id to request data`, () => {
    // arrange
    createVue({category_id: 'category_id'})
    vm.data.name = 'name'

    // act
    var requestData = vm.prepareRequestData()

    // assert
    then(() => {
      expect(requestData.name)
      .toBe('name')
      expect(requestData.category_id)
      .toBe('category_id')
    })
  })

  it(`fire event on successful request`, (done) => {
    // arrange
    createVue({category_id: null})
    spy('prepareRequestData')
    moxios.stubRequest(window.Laravel.base_url + 'parameters',
    {
      status: 200,
      response: {parameter: {id:1}}
    })

    // act
    vm.submit()

    then(() => {
      moxios.wait(() => {

      var emittedData = _.find(EventBus.fireHistory, (event, data) => {return _.keys(event)[0] == 'created-parameter'})['created-parameter'];

        expectEvent('created-parameter')

        expect(emittedData)
        .toBeDefined()

        expect(emittedData.id)
        .toBe(1)

        expect(vm.prepareRequestData.calledOnce)
        .toBe(true)
        done()
      })
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
*/