import Home from "./views/Home.vue";
import PublicMap from "./views/PublicMap.vue";
import MainApp from "./components/MainApp";
import MyMap from "./views/MyMap";
import MyCode from "./views/MyCode";
import Publish from "./views/admin/Publish";
import Users from "./views/admin/Users";
import Types from "./views/admin/Types";
import Profile from "./views/Profile";

export const routes = [
    {
        path: "/dashboard",
        component: MainApp,
        children: [
            {
                path: "",
                component: Home,
                name: ""
            },
            {
                path: "home",
                component: Home,
                name: "home"
            },
            {
                path: "public_map",
                component: PublicMap,
                name: "map"
            },
            {
                path: "my_map",
                component: MyMap,
                name: "mymap"
            },
            {
                path: "my_code",
                component: MyCode,
                name: "mycode"
            },
            {
                path: "publish",
                component: Publish,
                name: "publish"
            },
            {
                path: "users",
                component: Users,
                name: "users"
            },
            {
                path: "types",
                component: Types,
                name: "types"
            },
            {
                path: "profile",
                component: Profile,
                name: "profile"
            }
        ]
    }
];
