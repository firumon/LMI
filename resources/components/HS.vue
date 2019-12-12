<template>
    <section style="margin-top: 10px;" v-show="OIS">
        <ul class="tabs">
            <li class="tab" v-for="(name,pid) in masters.providers">
                <a :href="'#provider-'+pid" :key="'#provider-tab-'+pid">
                    <img :src="'/v/image/User/'+pid" class="circle left" height="48">
                    {{ name }}
                </a>
            </li>
        </ul>
        <div v-for="(name,pid) in masters.providers" :id="'provider-'+pid" :key="'#provider-tab-content-'+pid">
            <blockquote v-for="(jobs,service) in assigned[pid]" :key="'provider-'+pid+'-service-'+service">
                <strong>{{ masters.services[service] }}</strong>
                <ul class="collection">
                    <li class="collection-item avatar" v-for="job in jobs" :key="'provider-'+pid+'-job-'+job" v-show="!completed.includes(job)">
                        <img :src="'/v/image/Item/'+OIS[job].item" class="circle">
                        <span class="title">{{ OIS[job].order }}</span>
                        <p>{{ masters.items[OIS[job].item] }}</p>
                        <button data-target="job_progress" @click="selected_job = job" class="btn-small secondary-content waves-effect waves-light modal-trigger" style="font-size: 9px" :class="status_class[OIS[job].status]">{{ OIS[job].quantity }} - {{ OIS[job].status }}</button>
                    </li><li class="collection-item avatar" v-for="job in jobs" :key="'provider-'+pid+'-job-'+job" v-show="!completed.includes(job)">
                        <img :src="'/v/image/Item/'+OIS[job].item" class="circle">
                        <span class="title">{{ OIS[job].order }}</span>
                        <p>{{ masters.items[OIS[job].item] }}</p>
                        <button data-target="job_progress" @click="selected_job = job" class="btn-small secondary-content waves-effect waves-light modal-trigger" style="font-size: 9px" :class="status_class[OIS[job].status]">{{ OIS[job].quantity }} - {{ OIS[job].status }}</button>
                    </li><li class="collection-item avatar" v-for="job in jobs" :key="'provider-'+pid+'-job-'+job" v-show="!completed.includes(job)">
                        <img :src="'/v/image/Item/'+OIS[job].item" class="circle">
                        <span class="title">{{ OIS[job].order }}</span>
                        <p>{{ masters.items[OIS[job].item] }}</p>
                        <button data-target="job_progress" @click="selected_job = job" class="btn-small secondary-content waves-effect waves-light modal-trigger" style="font-size: 9px" :class="status_class[OIS[job].status]">{{ OIS[job].quantity }} - {{ OIS[job].status }}</button>
                    </li><li class="collection-item avatar" v-for="job in jobs" :key="'provider-'+pid+'-job-'+job" v-show="!completed.includes(job)">
                        <img :src="'/v/image/Item/'+OIS[job].item" class="circle">
                        <span class="title">{{ OIS[job].order }}</span>
                        <p>{{ masters.items[OIS[job].item] }}</p>
                        <button data-target="job_progress" @click="selected_job = job" class="btn-small secondary-content waves-effect waves-light modal-trigger" style="font-size: 9px" :class="status_class[OIS[job].status]">{{ OIS[job].quantity }} - {{ OIS[job].status }}</button>
                    </li><li class="collection-item avatar" v-for="job in jobs" :key="'provider-'+pid+'-job-'+job" v-show="!completed.includes(job)">
                        <img :src="'/v/image/Item/'+OIS[job].item" class="circle">
                        <span class="title">{{ OIS[job].order }}</span>
                        <p>{{ masters.items[OIS[job].item] }}</p>
                        <button data-target="job_progress" @click="selected_job = job" class="btn-small secondary-content waves-effect waves-light modal-trigger" style="font-size: 9px" :class="status_class[OIS[job].status]">{{ OIS[job].quantity }} - {{ OIS[job].status }}</button>
                    </li><li class="collection-item avatar" v-for="job in jobs" :key="'provider-'+pid+'-job-'+job" v-show="!completed.includes(job)">
                        <img :src="'/v/image/Item/'+OIS[job].item" class="circle">
                        <span class="title">{{ OIS[job].order }}</span>
                        <p>{{ masters.items[OIS[job].item] }}</p>
                        <button data-target="job_progress" @click="selected_job = job" class="btn-small secondary-content waves-effect waves-light modal-trigger" style="font-size: 9px" :class="status_class[OIS[job].status]">{{ OIS[job].quantity }} - {{ OIS[job].status }}</button>
                    </li>
                </ul>
            </blockquote>
            <blockquote v-if="provider_unassigned(pid).length">
                <strong>Unassigned</strong>
                <div class="card" v-for="job in provider_unassigned(pid)">
                    <div class="card-content">
                        <span class="card-title">{{ OIS[job].name }}</span>
                        Order: {{ OIS[job].order }}<br>
                        Service: {{ masters.services[OIS[job].service] }}<br>
                        Item: {{ masters.items[OIS[job].item] }}<br>
                        Quantity: {{ OIS[job].quantity }}
                    </div>
                    <div class="card-action">
                        <button data-target="job_progress" @click="selected_job = job" class="btn-small secondary-content waves-effect waves-light modal-trigger" style="font-size: 9px" :class="status_class[OIS[job].status]">{{ OIS[job].quantity }} - {{ OIS[job].status }}</button>
                    </div>
                </div>
            </blockquote>
        </div>
        <div id="job_progress" class="modal">
            <div class="modal-content" v-if="selected_job">
                <h4>{{ OIS[selected_job].name }}</h4>
                <p>
                    Order: {{ OIS[selected_job].order }}<br>
                    Service: {{ masters.services[OIS[selected_job].service] }}<br>
                    Item: {{ masters.items[OIS[selected_job].item] }}<br>
                    Quantity: {{ OIS[selected_job].quantity }}
                </p>
                <p class="center-align" v-if="OIS[selected_job].status !== masters.statuses.slice(-1).pop()">You are about to change status to<br><strong>{{ masters.statuses[masters.statuses.indexOf(OIS[selected_job].status)+1].toUpperCase() }}</strong></p>
            </div>
            <div class="modal-footer">
                <a href="#!" class="modal-close waves-effect waves-green btn-flat">Close</a>
                <button @click="advanceProgress" v-if="selected_job && OIS[selected_job].status !== masters.statuses.slice(-1).pop()" class="modal-close waves-effect waves-green btn-small deep-purple darken-2">Yes, {{ selected_job ? masters.statuses[masters.statuses.indexOf(OIS[selected_job].status)+1].toUpperCase() : '--' }}</button>
            </div>
        </div>
    </section>
</template>

<script>
    export default {
        name: "HS",
        data(){ return {
            data: [],
            masters: {
                items: {},
                services: {},
                providers: {},
                provider_services: {},
                statuses: ['unassigned','new','processing','completed'],
            },
            selected_job: null,
            unassigned: {},
            assigned: {},
            completed: [],
            status_class: { new:'teal',processing:'amber accent-3 pulse',completed:'disabled' }
        } },
        computed:{
            uuid(){ return this.$route.params.uuid },
            hub(){ return this.data[0].order_item.hub },
            OIS(){
                let OIs = {}; this.unassigned = Object.assign({}); this.assigned = Object.assign({});
                this.data.forEach(( { id,name,service,order_item:{ quantity,item,order },assigned } ) => {
                    OIs[id] = { quantity,item:item.id,service:service.id,name,order,status:this.getAssignedStatus(assigned) };
                    this.addMasterItem('items',item.id,item.name); this.addMasterItem('services',service.id,service.name);
                    if(!assigned.length) this.addUnassigned(service.id,id);
                    else {
                        let user = assigned[0]['user'];
                        this.addProviderJob(user.id,service.id,id);
                        OIs[id].provider = user.id;
                    }
                } );
                return OIs;
            },
        },
        methods: {
            fetchJobs(){ axios.post('hub/jobs',{ uuid:this.uuid }).then(({ data }) => this.data = data); },
            addMasterItem(item,id,name){ if(!this.masters[item].hasOwnProperty(id)) this.$set(this.masters[item],id,name); },
            addUnassigned(service,job){
                if(!this.unassigned.hasOwnProperty(service)) this.$set(this.unassigned,service,[]);
                if(this.unassigned[service].indexOf(job) === -1) this.unassigned[service].push(job);
            },
            addProviderJob(provider,service,job){
                if(!this.assigned.hasOwnProperty(provider)) this.$set(this.assigned,provider,{});
                if(!this.assigned[provider].hasOwnProperty(service)) this.$set(this.assigned[provider],service,[]);
                if(this.assigned[provider][service].indexOf(job) === -1) this.assigned[provider][service].push(job);
            },
            getAssignedStatus(assigned){
                if(!assigned.length) return this.masters.statuses[0];
                if(assigned[0].end_at) return this.masters.statuses[3];
                if(assigned[0].start_at) return this.masters.statuses[2];
                return this.masters.statuses[1];
            },
            advanceProgress(){
                axios.post('job/advance',{ ois:this.selected_job,uuid:this.uuid,user:this.OIS[this.selected_job].provider })
                    .then(({ data }) => this.updateJob(data));
            },
            updateJob(data){
                let dataIdx = this.data.findIndex(({ id }) => id === data.ois);
                if(!this.data[dataIdx]['assigned'].length) return this.data[dataIdx]['assigned'].push(data);
                this.data[dataIdx]['assigned'].splice(0,1); this.data[dataIdx]['assigned'].push(data);
                if(data.end_at) setTimeout(() => this.completed.push(data.ois),5000);
            },
            provider_unassigned(provider){
                let services = this.masters.provider_services[provider];
                let unassigned_services = Object.keys(this.unassigned).filter(service => services.includes(parseInt(service)));
                //console.error(provider,services,unassigned_services,unassigned_services.map(service => this.unassigned[service]).flat(1));
                return unassigned_services.map(service => this.unassigned[service]).flat(1);
            }
        },
        mounted(){
            axios.post('hub/providers',{ uuid:this.uuid })
                .then(({ data }) => data.forEach(({ id,name,services }) => {
                    this.addMasterItem('providers',id,name);
                    this.addMasterItem('provider_services',id,services.map(({ id }) => id));
                }))
                .finally(() => M.Tabs.init(document.querySelector('.tabs'),{ swipeable:true }));
            this.fetchJobs(); setInterval(this.fetchJobs,30000);
            M.Modal.init(document.getElementById('job_progress'));
        }
    }

    function toObj(keys, values) {
        let Obj = {}; values = Array.isArray(values) ? values : [values];
        (Array.isArray(keys) ? keys : [keys]).forEach((key,idx) => Obj[key] = values[idx]);
        return Obj;
    }
</script>
