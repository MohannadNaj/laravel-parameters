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

  it(`has a handleResponse method`, done => {
    // arrange
    createVue()

    expect(typeof vm.handleResponse)
    .toBe('function')

    done()
  })
})
