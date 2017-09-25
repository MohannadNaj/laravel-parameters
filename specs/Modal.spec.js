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

    vm.data_body = 'heeey!'
    expect(vm.data_body).toBe('heeey!')
  })

  it('renders the correct message', () => {
    createVue({
      title: 'Title!',
      save: 'Save Message!',
      html: '<p class="save-paragraph">Lorem!</p>'
    })

    then(() => {
      expect(vm.$el.querySelector('.modal-title').textContent).toBe('Title!')

      expect(vm.$el.querySelector('.btn.btn-primary').textContent).toBe(
        'Save Message!'
      )

      expect(vm.$el.querySelector('.save-paragraph').textContent).toBe('Lorem!')
    })
  })

  it('open modal', () => {
    createVue()
    then(vm.showModal).then(() => {
      expectEvent('modal.show.bs.modal')
    })
  })

  it('hide footer if requested', () => {
    createVue()
    vm.data_showFooter = false
    vm.data_close = 'Close Message'

    then(vm.showModal).then(() => {
      expect(vm.$el.textContent).not.toContain('Close Message')
    })
  })

  it('send event on "submit" button click', () => {
    createVue()
      .then(vm.showModal)
      .then(() => {
        $(vm.$el).find('#modal-submit')[0].click()
      })
      .then(() => {
        expectEvent('modal-submit')
      })
  })

  it('show remove-parameter component', () => {
    createVue()

    var component

    vm.showComponent('remove-parameter', 'Confirmation')

    then(() => {
      expect(vm.$el.textContent).toContain('Confirmation')

      then(
        () => {
          expect(vm.$el.textContent).toContain(
            vm.getComponent().$el.textContent
          )
        },
        null,
        vm.getComponent()
      )
    })
    expectEvent('modal.show.bs.modal')
  })

  it('show change-paramCategory component', () => {
    createVue()

    vm.showComponent('change-paramCategory', 'some title')

    then(() => {
      expect(vm.$el.textContent).toContain('some title')

      then(
        () => {
          expect(vm.$el.textContent).toContain(
            vm.getComponent().$el.textContent
          )
        },
        null,
        vm.getComponent()
      )
    })
    expectEvent('modal.show.bs.modal')
  })

  it('hide component after close', () => {
    createVue()

    vm.showComponent('change-paramCategory', 'some title')

    then(() => {
      expect(vm.$el.textContent).toContain('some title')
    })
      .then(
        () => {
          expect(vm.$el.textContent).toContain(
            vm.getComponent().$el.textContent
          )
        },
        null,
        vm.getComponent()
      )
      .then(
        () => {
          vm.hideModal()
        },
        null,
        vm
      )
      .then(() => {
        expectEvent('modal.hide.bs.modal')
      })
  })
})
