import App from './vue/App.vue';
import {createApp} from "vue";
import router from './vue/router'
import Paginate from "vuejs-paginate-next"

const app = createApp(App)

app.component('Paginate', Paginate)
app.use(router)
app.mount('#app')