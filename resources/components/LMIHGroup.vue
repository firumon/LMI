<template>
    <div id="hgroup">
        <h1><a href="#">{{ title }}</a></h1>
        <h2>{{ description }}</h2>
    </div>
</template>

<script>
    export default {
        name: "LMIHGroup",
        props: ['title','description','href']
    }
</script>
