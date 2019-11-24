<template>
    <article class="two_third">
        <div class="col s8">
            <div class="section">
                <div class="input-field" style="width: 47%"><input type="text" v-model="filter" @keyup.enter="search" placeholder="search"></div>
            </div>
            <div class="divider"></div>
            <table class="highlight">
                <thead><tr><th>Order ID</th><th>Customer</th><th>Date</th><th>Progress</th></tr></thead>
                <tbody>
                <tr @click="preview(idx)" v-for="(item,idx) in items" :key="'tr'+idx">
                    <td v-for="(key,idy) in keys" :key="'td'+idx+idy">{{ get(item,key) }}</td>
                </tr>
                </tbody>
            </table>

        </div>
        <div class="col s4">
            <div class="section">
                <button class="btn waves-effect center"><i class="material-icons left">print</i> Print</button>
                <div class="z-depth-1">
                    <h5>o</h5>
                </div>
            </div>
        </div>
    </article>
</template>

<script>
    export default {
        name: "Orders",
        data(){ return {
            filter:'',
            keys:['id','customer.name','date','progress'],
            data:{},
        }},
        methods: {
            search(){ let vm = this; axios.get('orders',{ params: { search: this.filter } }).then(({ data }) => this.add(data)); },
            get(ob,path){ return _.get(ob,path); },
            add(data){ let vm = this; _.forEach(data,(item) => { Vue.set(vm.data,item.id,item) }); },
            preview(id){ console.log(id) }
        },
        computed: {
            items(){ let filter = this.filter; return _.isEmpty(filter) ? this.data : _.filter(this.data,(item) => _.includes(_.values(item).join(' ').toLowerCase(),filter.toLowerCase()))},
        },
        created() {
            if(_.isEmpty(this.data)) this.search();
        }
    }
</script>
