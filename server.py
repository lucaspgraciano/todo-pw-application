from flask import Flask
from flask import render_template


app = Flask(__name__)

@app.route("/")
def home():
    return render_template('login.html')

@app.route("/login.html")
def login():
    return render_template('login.html')

@app.route("/register.html")
def register():
    return render_template('register.html')

@app.route("/index.html")
def index():
    return render_template('index.html')


if __name__ == '__main__':
    app.run(debug=True)