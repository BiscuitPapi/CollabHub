from flask import Flask, request, jsonify
import subprocess

app = Flask(__name__)

@app.route('/')
def index():
    input_text = request.args.get('text', '')
    escaped_text = input_text.replace("'", "\\'")

    python_script_path = '/Applications/XAMPP/xamppfiles/htdocs/FYP/Project/sentiment_analysis.py'
    command = f"python3 {python_script_path} '{escaped_text}'"

    try:
        output = subprocess.check_output(command, shell=True, text=True)
        positive_percentage = float(output)

        # Return a JSON response
        return jsonify({'positive_percent': positive_percentage})

    except subprocess.CalledProcessError as e:
        return jsonify({'error': str(e)})

if __name__ == '__main__':
    app.run(debug=True)