<template>
    <nav>
        <ul>
            <router-link tag="li" :to="{ name:menu }" v-for="(menu,idx) in menus" :class="{ last: idx === menus.length-1 }" :key="'menu'+idx"><a href="#">{{ menu }}</a></router-link>
        </ul>
    </nav>
<!--    <div class="nav-wrapper">-->
<!--        <ul class="left">-->
<!--            <router-link tag="li" :to="{ name:menu }" v-for="(menu,idx) in menus" :key="'menu'+idx"><a href="">{{ menu }}</a></router-link>-->
<!--        </ul>-->
<!--        <ul class="right">-->
<!--            <li><a href="">cPanel</a></li>-->
<!--            <li><a href="">Logout</a></li>-->
<!--            <li><a href="">Login</a></li>-->
<!--        </ul>-->
<!--    </div>-->
</template>

<script>
    export default {
        name: "LMIMenu",
        data(){ return {
            menus:['Orders','Invoices','Receipts','Deliveries'],
            active:'',
        }},
        computed:{
            classMenu(){ return (menu) => _.zipObject(['active'],[ this.active === menu ]) }
        },
        methods:{
            activateMenu(menu){ this.active = menu },
        }
    }
</script>
