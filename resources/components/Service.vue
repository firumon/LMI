<template>
    <div class="row">
        <div class="col s12" v-show="!details">
            <ul class="collection with-header">
                <li class="collection-header"><h4>Select Hub</h4></li>
                <li class="collection-item avatar" v-for="hub in hubs" :key="'hub-'+hub.id">
                    <img :src="'/v/image/Hub/'+hub.id" alt="" class="circle">
                    <div class="title">{{ hub.name }}</div>
                    <span>{{ hub.address || 'No Address' }}</span>
                    <a @click.prevent="detail(hub.id)" class="waves-effect waves-light btn-small secondary-content"><i class="material-icons">send</i></a>
                </li>
            </ul>
        </div>
        <div class="col s12" v-show="!!details">
            <div class="card">
                <div class="card-image">
                    <img :src="details.image">
                </div>
                <div class="card-content">
                    <div class="card-title">
                        <i class="material-icons" style="cursor: pointer" @click="back">arrow_back</i>
                        {{ details.name }}</div>
                    <p v-if="details.address">{{ details.address }}</p>
                    <p v-if="details.phone">{{ details.phone }}</p>
                    <h5>Providers</h5>
                    <blockquote>{{ providers }}</blockquote>
                    <h5>Services</h5>
                    <blockquote>{{ services }}</blockquote>
                </div>
                <div class="card-action"><a href="" class="btn-small disabled"></a><a class="activator waves-effect waves-light btn-small right">Login</a></div>
                <div class="card-reveal">
                    <span class="card-title grey-text text-darken-4">Enter Access Password<i class="material-icons right">close</i></span>
                    <br/><br/>
                    <div class="col s6 offset-s3 input-field"><input id="access_password" type="password" v-model="pin" class="center" placeholder="Password"></div>
                    <a class="waves-effect waves-light btn col s6 offset-s3" style="margin-bottom: 10px;" @click.prevent="authenticate">Authenticate</a>
                    <div class="progress col s6 offset-s3" v-show="authenticating"><div class="indeterminate"></div></div>
                    <div class="green pulse info" v-show="redirecting">Authentication success, you will be redirected soon...</div>
                    <div class="red pulse info" v-show="error && !pin">Authentication error.. Please enter again..</div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: "Service",
        data() {
            return {
                hubs: [],
                details: false,
                authenticating: false,
                pin: null,
                redirecting: false,
                error: false,
                uuid: null,
            }
        },
        computed: {
            services(){
                return (this.details && this.details.services && this.details.services.length)
                    ? this.details.services.map(({service:{ name }}) => name).join(', ')
                    : 'No services assigned yet'
            },
            providers(){
                return (this.details && this.details.users && this.details.users.length)
                    ? this.details.users.filter(({ groups }) => groups.map(({ name }) => name).includes('service_providers')).map(({ name }) => name).join(', ')
                    : 'No users assigned yet'
            }
        },
        methods: {
            detail(id){
                axios.get(`hub/${id}/detail`).then(({data}) => this.details = data)
            },
            back(){
                this.details = false;
            },
            authenticate(){
                this.authenticating = true; this.error = false;
                if(this.pin){
                    axios.post(`hub/authenticate`,{ hub:this.details.id,pin:this.pin }).then(this.authenticated)
                }
            },
            authenticated({ data:{ success,uuid } }){
                this.authenticating = false; this.pin = null;
                this[success ? 'redirecting' : 'error'] = true;
                this.uuid = uuid;
            }
        },
        created() {
            axios.get('hubs').then(({data}) => this.hubs = data)
        },
        watch:{
            uuid(uuid){ if(uuid) setTimeout(() => this.$router.push({ name:'HS', params:{ uuid }}),2000) }
        }
    }
</script>

<style scoped>
    .info { clear: both; margin-top: 12px; padding: 5px; text-align: center; border-radius: 5px; font-size: 12px; }
</style>
