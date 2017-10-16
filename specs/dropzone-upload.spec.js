import dropzoneUpload from '../resources/assets/js/components/dropzone-upload'

describe('dropzone-upload Component', () => {
  beforeEach(() => {
    if (vm) vm.$destroy()

    moxios.install()
    window.specComponent = dropzoneUpload
    EventBus.clearHistory()
    window.sinonSandbox = sinon.createSandbox()
    if (vm) vm.notificationStore.state = []
  })

  afterEach(() => {
    moxios.uninstall()
    sinonSandbox.restore()
  })

  it(`has a handleResponse method`, () => {
    createVue()

    expect(typeof vm.handleResponse)
    .toBe('function')
  })

  it(`handleResponse controls: is_uploaded`, (done) => {
    createVue()

    //$(vm.$el).find('.dz-hidden-input')[0]
    //$(vm.$el).find(`#${vm.modalId} .btn`)[1].click()
    then(() => {
      // $(vm.$el).find('.dz-hidden-input')[0]
      done()
    })
  })
})
