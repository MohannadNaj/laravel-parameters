expectEvent = (eventName, component = null) => {
    if(component == null)
        component = window.vm

    component.$nextTick(() => {
      var expectedEvent = eventName;

      var eventInHistory = EventBus.getHistoryEvents()
        .filter((e) => e == expectedEvent)

      expect(
        expectedEvent
      ).toEqual(eventInHistory[0])
    })
}

createVue = (props = null, component = null)=> {

    if(component == null)
        component = window.specComponent;

    let Ctor = Vue.extend(component)

    window.vm = new Ctor({
      propsData: props
    }).$mount()

    return window.vm
}

then = (callback, data = null, component = null) => {
    if(component == null)
        component = window.vm;

    component.$nextTick(() => {callback(data)})
    return {then: then, next: then}
}
