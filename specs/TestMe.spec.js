import Vue from 'vue';
// The path is relative to the project root.
import TestMe from '../resources/assets/js/components/TestMe';

// Here are some Jasmine 2.0 tests, though you can
// use any test runner / assertion library combo you prefer
describe('TestMe', () => {
  // Inspect the raw component options
  it('has a created hook', () => {
    expect(typeof TestMe.created).toBe('function')
  })
  // Evaluate the results of functions in
  // the raw component options
  it('sets the correct default data', () => {
    expect(typeof TestMe.data).toBe('function')
    const defaultData = TestMe.data()
    expect(defaultData.message).toBe('hello!')
  })
  // Inspect the component instance on mount
  it('correctly sets the message when created', () => {
    const vm = new Vue(TestMe).$mount()
    vm.message = "heeey!";
    expect(vm.message).toBe('heeey!')
  })
  // Mount an instance and inspect the render output
  it('renders the correct message', () => {
    const Ctor = Vue.extend(TestMe)
    const vm = new Ctor().$mount()
    expect(vm.$el.textContent).toBe('bye!')
  })

  // Change on DOM events
  it('correctly changed', () => {
    const Ctor = Vue.extend(TestMe)
    const vm = new Ctor().$mount()

    expect(vm.clicked).toBe(false)
    vm.$el.click()

    expect(vm.clicked).toBe(true)
  })
})

