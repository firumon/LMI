<template>
    <section id="shout">
        <h1>{{ heading }}</h1>
        <p><slot></slot></p>
    </section>
</template>

<script>
    export default {
        name: "LMIShout",
        props: ['heading']
    }

</script>
