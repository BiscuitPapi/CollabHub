from flask import Flask, request, jsonify
from transformers import pipeline

app = Flask(__name__)

@app.route('/')
def analyze_sentiment():
    input_text = request.args.get('text', '')

    # Load the sentiment analysis pipeline with BERT
    sentiment_analysis_bert = pipeline("sentiment-analysis", model="nlptown/bert-base-multilingual-uncased-sentiment")

    try:
        # Perform sentiment analysis
        result_bert = sentiment_analysis_bert(input_text)

        # Extract the sentiment label and score
        sentiment_label = result_bert[0]['label']
        sentiment_score = result_bert[0]['score']

        # Convert score to percentage
        positive_percent = sentiment_score * 100

        # Return a JSON response with label and score
        return jsonify({
            'sentiment_label': sentiment_label,
            'sentiment_score': sentiment_score,
            'positive_percent': positive_percent
        })

    except Exception as e:
        return jsonify({'error': str(e)})

if __name__ == '__main__':
    app.run(debug=True)
