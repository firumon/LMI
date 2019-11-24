<template>
    <a href="/home" class="brand-logo">{{ title }}</a>
</template>

<script>
    export default {
        name: "LMIHGroup",
        props: ['title','description','href']
    }
</script>
