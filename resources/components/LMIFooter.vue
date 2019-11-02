<template>
    <footer id="footer" class="clear">
        <p class="fl_left">Copyright &copy; {{ year }} - All Rights Reserved - <a href="#">{{ title }}</a></p>
        <p class="fl_right">Developed &amp; Maintained by <a target="_blank" href="http://firumon.com" title="Firose Hussain">Firose Hussain</a></p>
    </footer>
</template>

<script>
    export default {
        name: "LMIFooter",
        props: ['year','title']
    }
</script>
