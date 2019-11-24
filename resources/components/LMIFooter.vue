<template>
    <div class="footer-copyright">
        <div class="container">
            <p class="left">Copyright &copy; {{ year }} - All Rights Reserved - <a href="#">{{ title }}</a></p>
            <p class="right">Developed &amp; Maintained by <a target="_blank" href="http://firumon.com" title="Firose Hussain">Firose Hussain</a></p>
        </div>
    </div>
</template>

<script>
    export default {
        name: "LMIFooter",
        props: ['year', 'title']
    }
</script>
