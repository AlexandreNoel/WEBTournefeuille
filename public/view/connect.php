<!doctype html>
<html lang="fr">

<!--Todo replace with the real connectView-->

<head>
    <meta charset="utf-8">
    <title>Connect</title>
</head>

<body class="background-neutral">
<button type="button" onclick="location.href = '/index.php';">homepage</button>
<h1> Connect here : </h1>
<div class="section">
    <div class="section-container">
        <form action="/connect.php" method="post">
            <div>
                <label>mail</label>
                <input
                    type="text"
                    name="mail"
                    placeholder="mail"
                    value="<?php echo $view['user']['mail'] ?? null ?>"
                >
            </div>
            <?php if (isset($view['errors']['mail']) && $view['errors']['mail']): ?>
                <p>
                    <?php echo $view['errors']['mail'] ?>
                </p>
            <?php endif; ?>
            <div>
                <label>Password</label>
                <input
                    type="text"
                    name="password"
                    placeholder="password"
                    value="<?php echo $view['user']['password'] ?? null ?>"
                >
            </div>
            <?php if  (isset($view['errors']['password']) && $view['errors']['password']): ?>
                <p>
                    <?php echo $view['errors']['password'] ?>
                </p>
            <?php endif; ?>
            <?php if (isset($view['errors']['mail-password']) && $view['errors']['mail-password']): ?>
                <p>
                    <?php echo $view['errors']['mail-password'] ?>
                </p>
            <?php endif; ?>
            <?php if (isset($view['errors']['mail-password']) && $view['errors']['mail-password']): ?>
                <p>
                    <?php echo $view['errors']['mail-password'] ?>
                </p>
            <?php endif; ?>
            <input type="submit" value="Log in">
        </form>
    </div>
     <button onclick="location.href = 'forgotten-password.php';">Forgot Password</button>
</div>
</body>
</html>