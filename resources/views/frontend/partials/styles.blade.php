<style>
    * {
        box-sizing: border-box;
        margin: 0;
        padding: 0;
    }

    body {
        font-family: Arial, sans-serif;
        color: #1f1f1f;
    }

    .container {
        display: flex;
        min-height: 100vh;
    }

    .left-side,
    .right-side {
        flex: 1;
        padding: 40px;
    }

    .right-side {
        background-color: #f5f5f5;
    }

    .logo {
        max-width: 150px;
        margin-bottom: 40px;
    }

    .form-container {
        max-width: 400px;
        margin: 0 auto;
    }

    h1 {
        font-size: 32px;
        color: #0070f3;
        margin-bottom: 10px;
    }

    p.description {
        color: #535862;
        font-size: 16px;
        margin-bottom: 30px;
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        display: block;
        margin-bottom: 6px;
        font-weight: 500;
    }

    input[type="email"],
    input[type="password"] {
        width: 100%;
        padding: 10px;
        font-size: 16px;
        border: 1px solid #ddd;
        border-radius: 4px;
    }

    .remember-forgot {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 20px;
        font-size: 14px;
    }

    .remember-forgot label {
        font-weight: normal;
    }

    .btn {
        display: block;
        width: 100%;
        padding: 12px;
        font-size: 16px;
        border: none;
        border-radius: 4px;
        margin-bottom: 15px;
        cursor: pointer;
    }

    .btn-primary {
        background-color: #0070f3;
        color: white;
    }

    .btn-google {
        background-color: white;
        border: 1px solid #ddd;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .btn-google img {
        width: 20px;
        margin-right: 10px;
    }

    .signup-link {
        text-align: center;
        margin-top: 20px;
    }

    .signup-link a {
        font-weight: 600;
        color: #0070f3;
        text-decoration: none;
    }

    .signin-img {
        width: 100%;
        height: 100%;
        object-fit: cover;
    }
</style>
