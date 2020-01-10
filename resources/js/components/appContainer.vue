<template>
<div>
    <v-app id="app">
        <v-navigation-drawer v-model="drawer" app style="z-index:10000">
            <v-list dense>
                <v-list-item link>
                    <v-list-item-action>
                        <v-icon>fa-home</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Home</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item :to="{name:'pdaMap'}" link>
                    
                    <v-list-item-action>
                        <v-icon>fa-map-marker-alt</v-icon>
                    </v-list-item-action>
                    
                    <v-list-item-content>
                        <v-list-item-title>Public Map</v-list-item-title>
                    </v-list-item-content>
                    
                </v-list-item>
                <v-list-item link>
                    <v-list-item-action>
                        <v-icon>mdi-home</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>My Map</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item link>
                    <v-list-item-action>
                        <v-icon>fa-code</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>My Code</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item link>
                    <v-list-item-action>
                        <v-icon>fa-image</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>My Images</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item link>
                    <v-list-item-action>
                        <v-icon>fa-comment</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Contact</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-divider></v-divider>
                <v-list-item link>
                    <v-list-item-action>
                        <v-icon>fa-bus</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Publish</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item link>
                    <v-list-item-action>
                        <v-icon>fa-user</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Users</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item link>
                    <v-list-item-action>
                        <v-icon>fa-map-signs</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Types</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-divider></v-divider>
                <v-list-item link>
                    <v-list-item-action>
                        <v-icon>fa-user-circle</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Profile</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
                <v-list-item link @click="logout">
                    <v-list-item-action>
                        <v-icon>fa-sign-out-alt</v-icon>
                    </v-list-item-action>
                    <v-list-item-content>
                        <v-list-item-title>Log Out</v-list-item-title>
                    </v-list-item-content>
                </v-list-item>
            </v-list>
        </v-navigation-drawer>

        <v-app-bar app color="white" style="z-index:9999">
            <v-app-bar-nav-icon @click.stop="drawer = !drawer" />
            <v-img
      src="https://pdabullying.com/img/logo.png"
      lazy-src="https://pdabullying.com/img/logo.png"
      
      class="grey lighten-2"
        max-width="150"
      max-height="300"
    ></v-img>
        </v-app-bar>
    
        <v-content>
            
        
            
      
    
            <v-container class="full-height" fluid>
                <v-row align="center" justify="center">
                    <v-col class="text-center"> 
                        <map-component class="map"></map-component>
                    
                      
                    </v-col>
                </v-row>
            </v-container>
           
        </v-content>
        
        
    </v-app>
    
     </div>
</template>

<script>


export default {
    
    props: {
        source: String
    },
    data: () => ({
        drawer: null,
        
    }),
    methods: {
        logout() {
            axios.post("/logout").then(response => {
                window.location.href = "login";
            });
        }
    }
};
</script>
<style scoped>
    
</style>
