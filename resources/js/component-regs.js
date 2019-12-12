// const requireComponent = require.context('./../components', false, /[A-Z]\w+\.(vue)$/);
// requireComponent.keys().forEach(fileName => {
//     const componentConfig = requireComponent(fileName);
//     const componentName = _.upperFirst(_.camelCase(fileName.split('/').pop().replace(/\.\w+$/, '')));
//     Vue.component(componentName, componentConfig.default || componentConfig)
// });
// Vue.component('LMIMenu', require('../components/LMIMenu.vue').default);

const files = require.context('./../components', true, /\.vue$/i);
files.keys().map(key => Vue.component(key.split('/').pop().split('.')[0], files(key).default));
