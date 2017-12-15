<template>
    <nav class="navbar navbar-default navbar-fixed-top">
        <div class="container">
            <div class="navbar-header">
                <router-link class="navbar-brand" to="/manage">Admin</router-link>
            </div>
            <div id="navbar" class="navbar-collapse collapse">
                <ul class="nav navbar-nav navbar-right">
                    <router-link to="/about" tag="li">
                        <a>About</a>
                    </router-link>
                </ul>
            </div><!--/.nav-collapse -->
        </div>
    </nav>
</template>

<script>
    export default {

    }
</script>
