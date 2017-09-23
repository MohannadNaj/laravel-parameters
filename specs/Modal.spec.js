import Modal from '../resources/assets/js/components/Modal'

describe('Modal Component', () => {
  beforeEach(() => {
    window.specComponent = Modal
  })

  it('sets the correct default data', () => {
    expect(typeof Modal.data).toBe('function')
    let defaultData = Modal.data()
    expect(defaultData.data_save).toBe('')
  })

  it('correctly sets the message when mounted', () => {
    createVue()

    vm.data_body = "heeey!"
    expect(vm.data_body).toBe('heeey!')
  })

  it('renders the correct message', () => {

    createVue( {
      title: 'Title!',
      save: 'Save Message!',
      html: '<p class="save-paragraph">Lorem!</p>'
    })

    then(() => {
      expect(vm.$el.querySelector('.modal-title').textContent)
      .toBe('Title!')

      expect(vm.$el.querySelector('.btn.btn-primary').textContent)
      .toBe('Save Message!')

      expect(vm.$el.querySelector('.save-paragraph').textContent)
      .toBe('Lorem!')
    })
  })

  it('open modal', () => {
    createVue()
    then(vm.showModal)
    .then(() => {
      var expectedEvent = "modal.show.bs.modal";

      var eventInHistory = EventBus.getHistoryEvents()
        .filter((e) => e == expectedEvent)

      expect(
        expectedEvent
      ).toEqual(eventInHistory[0])
    })
  })

  it('show remove-parameter component', () => {
    createVue()
    
    var component

    vm.showComponent('remove-parameter', "Confirmation")

    vm.showModalAfter(() => {
      component = vm.getComponent()
      vm.setComponentData({parameter: TestData.parameters[0]})
    })

    then(()=> {
      expect(vm.$el.textContent).toContain('Confirmation')

      then(()=> {
        expect(component.$el.textContent).toContain(TestData.parameters[0].name)
      },
      null, component)
    })
    expectEvent('modal.show.bs.modal')
  })

  it('show change-paramCategory component', () => {
    createVue()

    var component

    var parameter = TestData.categorized_parameters[0]

    vm.showComponent('change-paramCategory', parameter.label)

    vm.showModalAfter(x => {
      component = vm.getComponent()
      vm.setComponentData(
        {
          parameter: parameter,
          categories: appCategory({title: 'change-paramCategory test'}, 2)
        })

      component.init()
    })

    then(()=> {
      expect(vm.$el.textContent).toContain(parameter.label)

      then(()=> {
        expect(component.$el.textContent)
        .toContain('change-paramCategory test')
      },
      null, component)
    })
    expectEvent('modal.show.bs.modal')
  })
})
