<template>
    <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
        <form action="/login" method="post">
            <input type="hidden" name="_token" :value="csrf">
            username: <input type="text" name="email"><br>
            password: <input type="text" name="password"><br>
            <input type="submit" value="inloggen">
        </form>
    </div>
</template>

<script>
    export default {
        data() 
        {
            return {
                csrf: document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            }
        }
    }
</script>


