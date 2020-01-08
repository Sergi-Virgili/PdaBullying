import Vue from 'vue'
import Router from 'vue-router'


Vue.use(Router)

export default new Router({
    routes: [
        {
            path: '/pda',
            name: '',
            component: require('./views/pdaMap'),
                children:
                [
                    { path: '/pda_map', name: 'pdaMap', component: require('./views/pdaMap').default },
                ]
        }
    ],
    mode: 'history'
})