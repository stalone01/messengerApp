<template>
       <div id="app" class="bg-background min-h-screen flex items-center justify-center">
        <form class="bg-card p-8 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-2xl font-bold text-primary text-center mb-6">Login</h2>
            <div class="mb-4">
                <label for="username" class="block text-sm font-medium text-primary">Username</label>
                <input id="username" type="text" class="w-full mt-1 px-3 py-2 rounded-lg bg-input text-primary ring ring-primary focus:ring focus:ring-primary focus:outline-none" placeholder="Enter your username" />
            </div>
            <div class="mb-6">
                <label for="password" class="block text-sm font-medium text-primary">Password</label>
                <input id="password" type="password" class="w-full mt-1 px-3 py-2 rounded-lg bg-input text-primary ring ring-primary focus:ring focus:ring-primary focus:outline-none" placeholder="Enter your password" />
            </div>
            <button type="submit" id="loginBtn" class="w-full bg-primary text-primary-foreground py-2 rounded-lg hover:bg-primary/80 transition-colors duration-300">Login</button>
        </form>
    </div>
</template>
<script>
export default{
    name: 'Login',
    components:{

    }
}
</script>
<style>
    body {
        --background: #f7fafc;
        --foreground: #1a202c;
        --primary: #3182ce;
        --border: #e2e8f0;
        --input: #edf2f7;
        --ring: #63b3ed;
        --primary-foreground: #ffffff;
    }
    body.dark {
        --background: #1a202c;
        --foreground: #cbd5e0;
        --primary: #63b3ed;
        --border: #2d3748;
        --input: #4a5568;
        --ring: #3182ce;
        --primary-foreground: #1a202c;
    }
    #app {
        background-color: var(--background);
        color: var(--foreground);
    }
    .bg-card {
        background-color: var(--card);
        color: var(--card-foreground);
    }
    .text-primary {
        color: var(--primary);
    }
    .text-primary-foreground {
        color: var(--primary-foreground);
    }
    .bg-input {
        background-color: var(--input);
    }
    .ring {
        border-color: var(--ring);
    }
    .focus\:ring {
        box-shadow: 0 0 0 3px var(--ring);
    }
    .hover\:bg-primary\/80:hover {
        background-color: rgba(49, 130, 206, 0.8);
    }
    #loginBtn {
        background-color: var(--primary);
    }
    #loginBtn:hover {
        background-color: rgba(49, 130, 206, 0.8);
    }
</style>
 