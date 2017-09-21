expectEvent = (eventName, vm) => {
    vm.$nextTick(() => {
      var expectedEvent = eventName;

      var eventInHistory = EventBus.getHistoryEvents()
        .filter((e) => e == expectedEvent)

      expect(
        expectedEvent
      ).toEqual(eventInHistory[0])
    })
}
