<template>
    <v-app>
        <v-card fluid>
            <v-list dense>
                <v-list-item>
                    <v-checkbox
                        color="grey"
                        v-model="selected"
                        label="Type1"
                        value="Type1"
                    ></v-checkbox>
                </v-list-item>
                <v-list-item>
                    <v-checkbox
                        color="grey"
                        v-model="selected"
                        label="Type2"
                        value="Type2"
                    ></v-checkbox>
                </v-list-item>
            </v-list>
        </v-card>
    </v-app>
</template>

<script>
export default {
    data() {
        return {};
    }
};
</script>

<style>
h1 {
    background-color: black;
}
</style>
