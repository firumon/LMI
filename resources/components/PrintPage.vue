<template>
    <div class="container" style="margin-top: 10px">
        <div class="row">
            <div class="col s7">
                <template v-for="item in items"><a class="btn waves-effect indigo" :class="btnClass(item)" @click="listItems(item)">{{ item }}</a>&nbsp;</template>
                <div class="collection indigo lighten-4">
                    <a v-for="data in execData" class="collection-item">{{ getHtml(data) }}</a>
                </div>
                <div class="row" style="margin-top: 27px;" v-if="execData.length !== 0">
                    <div class="col s9"><input id="filter" v-model="filter" type="text" class=""></div>
                    <div class="col s3"><a class="btn waves-effect indigo">Search</a></div>
                </div>
            </div>
            <div class="col s5 z-depth-1-half">
                <h1>Preview</h1>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        name: 'PrintPage',
        data(){ return {
            active: 1,
            items: ['Orders','Invoices','Receipts','Deliveries'],
            execData: [],
            filter: '',
        }},
        computed: {

        },
        methods: {
            btnClass(n){ return ((this.active == n) ? 'darken' : 'lighten') + '-3'; },
            listItems(itm){
                this.active = itm;
                axios.get(_.toLower(itm)).then(({ data }) => { this.execData = data; })
            },
            getHtml(data){ return _.concat(
                [data.id,data.date],
                (this.active === 'Deliveries' ? []
                    : (this.active === 'Receipts' ? [data.invoice,data.amount]
                        : [((this.active === 'Invoices') ? data.order : ''),data.customer.name,data.progress]))
            ).join(' -> '); },
            listOrders(){ axios.get('orders').then(({ data }) => { this.orders = data; }) },
            listInvoices(){ axios.get('invoices').then(({ data }) => { this.invoices = data; }) },
            listReceipts(){ axios.get('receipts').then(({ data }) => { this.receipts = data; }) },
            listDeliveries(){ axios.get('deliveries').then(({ data }) => { this.deliveries = data; }) },
        }
    }
</script>
