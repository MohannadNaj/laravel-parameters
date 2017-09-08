import Vue from 'vue';

import Modal from '../resources/assets/js/components/Modal';

describe('Modal', () => {

  it('has a mounted hook', () => {
    expect(typeof Modal.mounted).toBe('function')
  })


  it('sets the correct default data', () => {
    expect(typeof Modal.data).toBe('function')
    let defaultData = Modal.data()
    expect(defaultData.data_save).toBe('')
  })

  it('correctly sets the message when mounted', () => {
    let vm = new Vue(Modal).$mount()
    vm.data_body = "heeey!";
    expect(vm.data_body).toBe('heeey!')
  })

  it('renders the correct message', () => {
    let Ctor = Vue.extend(Modal)
    let vm = new Ctor({
      propsData: {
        title: 'Title!',
        save: 'Save Message!',
        html: '<p class="save-paragraph">Lorem!</p>'
      }
    }).$mount()

    vm.$nextTick(() => {
      expect(vm.$el.querySelector('.modal-title').textContent)
      .toBe('Title!')
      
      expect(vm.$el.querySelector('.btn.btn-primary').textContent)
      .toBe('Save Message!')

      expect(vm.$el.querySelector('.save-paragraph').textContent)
      .toBe('Lorem!')
    })
  })
})

