<template>
    <div>
        <div class="show-on-medium-and-down">
            <a href="#" data-target="slide-out" class="sidenav-trigger"><i class="material-icons">menu</i></a>
            <ul id="slide-out" class="sidenav">
                <router-link tag="li" :to="{ name:menu }" v-for="(menu,idx) in menus" :class="{ last: idx === menus.length-1 }" :key="'menu'+idx"><a class="waves-effect sidenav-close" href="#">{{ menu }}</a></router-link>
            </ul>
        </div>
        <ul class="hide-on-med-and-down"><router-link tag="li" :to="{ name:menu }" v-for="(menu,idx) in menus" :class="{ last: idx === menus.length-1 }" :key="'menu'+idx"><a href="#">{{ menu }}</a></router-link></ul>
    </div>
</template>

<script>
    export default {
        name: "LMIMenu",
        data(){ return {
            menus:['Orders','Invoices','Receipts','Deliveries','Service'],
            active:'',
            mobile: ISMOBILE,
        }},
        computed:{
            classMenu(){ return (menu) => _.zipObject(['active'],[ this.active === menu ]) }
        },
        methods:{
            activateMenu(menu){ this.active = menu },
        },
        created() {
            M.Sidenav.init(document.querySelectorAll('.sidenav'), { edge:'right' });
        }
    }
</script>
