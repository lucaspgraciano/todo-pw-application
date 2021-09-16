from flask import Flask
from flask import render_template

app = Flask(__name__)

@app.route("/")
def home(name=None):
    return render_template('login.html', name=name)

@app.route("/login.html")
def login(name=None):
    return render_template('login.html', name=name)

@app.route("/register.html")
def register(name=None):
    return render_template('register.html', name=name)

if __name__ == '__main__':
    app.run(debug=True)