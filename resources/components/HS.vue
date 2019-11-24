<template>
    <section style="margin-top: 10px;">
        <ul class="tabs">
            <li class="tab" v-for="(name,pid) in masters.providers" @click="provider = pid">
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
                    <li class="collection-item avatar" v-for="job in jobs" :key="'provider-'+pid+'-job-'+job">
                        <span class="badge new" :data-badge-caption="'new'">{{ OIS[job].quantity }}</span>
                        <img :src="'/v/image/Item/'+OIS[job].item" class="circle">
                        <span class="title">{{ OIS[job].order }}</span>
                        <p>{{ OIS[job].name }}<br>{{ masters.items[OIS[job].item] }}</p>
                    </li>
                </ul>
            </blockquote>
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
            },
            provider: null,
            unassigned: {},
            assigned: {},
        } },
        computed:{
            uuid(){ return this.$route.params.uuid },
            hub(){ return this.data[0].order_item.hub },
            OIS(){
                let OIs = {};
                this.data.forEach(( { id,name,service,order_item:{ quantity,item,order },assigned } ) => {
                    OIs[id] = { quantity,item:item.id,service:service.id,name,order };
                    this.addMasterItem('items',item.id,item.name); this.addMasterItem('services',service.id,service.name);
                    if(!assigned.length)this.addUnassigned(service.id,id);
                    else {
                        let user = assigned[0]['user'];
                        this.addMasterItem('provider_services',user.id,user['services'].map(({ id }) => id));
                        this.addProviderJob(user.id,service.id,id);
                    }
                } );
                return OIs;
            }
        },
        methods: {
            addMasterItem(item,id,name){ if(!this.masters[item].hasOwnProperty(id)) this.$set(this.masters[item],id,name); },
            addUnassigned(service,job){ if(!this.unassigned.hasOwnProperty(service)) this.$set(this.unassigned,service,[]); this.unassigned[service].push(job); },
            addProviderJob(provider,service,job){
                if(!this.assigned.hasOwnProperty(provider)) this.$set(this.assigned,provider,{});
                if(!this.assigned[provider].hasOwnProperty(service)) this.$set(this.assigned[provider],service,[]);
                this.assigned[provider][service].push(job);
            },
            getAssigned(pid){ return this.assigned[pid] },
        },
        mounted(){
            axios.post('hub/jobs',{ uuid:this.uuid }).then(({ data }) => this.data = data);
            axios.post('hub/providers',{ uuid:this.uuid })
                .then(({ data }) => this.masters.providers = (data && Array.isArray(data))
                    ? toObj(data.map(({ id }) => id),data.map(({ name }) => name))
                    : {} )
                .finally(() => M.Tabs.init(document.querySelector('.tabs'),{ swipeable:true }))
        }
    }

    function toObj(keys, values) {
        let Obj = {}; values = Array.isArray(values) ? values : [values];
        (Array.isArray(keys) ? keys : [keys]).forEach((key,idx) => Obj[key] = values[idx]);
        return Obj;
    }
</script>
