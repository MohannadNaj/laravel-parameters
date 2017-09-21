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
    then(() => {
      var expectedEvent = "modal.show.bs.modal";

      var eventInHistory = EventBus.getHistoryEvents()
        .filter((e) => e == expectedEvent)

      expect(
        expectedEvent
      ).toEqual(eventInHistory[0])
    })
  })

  it('show remove-parameter component', () => {
    let Ctor = Vue.extend(Modal)
    let vm = new Ctor().$mount()
    var component;

    vm.showComponent('remove-parameter', "Confirmation")

    vm.showModalAfter(x => {
      component = vm.$refs['component']
      component.parameter = {name:'some param'}
    })

    then(()=> {
      expect(vm.$el.textContent).toContain('Confirmation')

      component.$nextTick(()=> {
        expect(component.$el.textContent).toContain('some param')
      })
    })
    expectEvent('modal.show.bs.modal')
  })
})
