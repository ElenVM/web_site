<div class="article">
    <div class="contacts">
        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d5130.486447612005!2d36.209402340490726!3d49.98804926457425!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x4127a0553b341df9%3A0xbb3f1e73f0cafea!2z0K7QttC90YvQuSDQstC-0LrQt9Cw0Ls!5e0!3m2!1sru!2sua!4v1482421755853" width="300" height="300" frameborder="0" style="border: 0" allowfullscreen></iframe>
        </div>
        <div class="feedback">
            <h2 class="title">Форма обратной связи</h2>
            <form action="<?= url('/feedback') ?>" method="post" class="form">
                <div class="field">
                    <label for="name" class="label">Имя:</label>
                    <input id="name" name="name" type="text" class="input" required>
                </div>
                <div class="field">
                    <label for="email" class="label">E-mail:</label>
                    <input id="email" name="email" type="email" class="input" required>
                </div>
                <div class="field">
                    <label for="title" class="label">Заголовок:</label>
                    <input id="title" name="title" type="text" class="input" required>
                </div>
                <div class="field">
                    <label for="message" class="label">Сообщение:</label>
                    <textarea id="message" name="message" class="input" required></textarea>
                </div>
                <div class="control">
                    <button class="btn">Отправить</button>
                </div>
            </form>
        </div>
    </div>
</div>