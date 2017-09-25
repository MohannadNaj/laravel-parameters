expectEvent = (eventName, component = null, eventType = 'Fire') => {
  if (component == null) component = window.vm

  component.$nextTick(() => {
    var expectedEvent = eventName

    var eventInHistory = EventBus[`get${eventType}History`]().filter(
      e => e == expectedEvent
    )

    expect(expectedEvent).toEqual(eventInHistory[0])
  })
}

expectListenEvent = (eventName, component = null) => {
  return expectEvent(eventName, component, 'Listen')
}

createVue = (props = null, component = null) => {
  if (component == null) component = window.specComponent

  let Ctor = Vue.extend(component)

  window.vm = new Ctor({
    propsData: props
  }).$mount()

  window.vm.then = then

  return window.vm
}

then = (callback, data = null, component = null) => {
  if (component == null) component = window.vm

  component.$nextTick(() => {
    callback(data)
  })
  return { then: then, next: then }
}
