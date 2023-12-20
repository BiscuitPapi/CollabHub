# Import necessary libraries
from transformers import pipeline
import sys

def analyze_sentiment(text):
    # Load the sentiment analysis pipeline with BERT
    sentiment_analysis_bert = pipeline("sentiment-analysis", model="nlptown/bert-base-multilingual-uncased-sentiment")

    # Perform sentiment analysis
    result_bert = sentiment_analysis_bert(text)

    # Extract the sentiment label and score
    sentiment_label = result_bert[0]['label']
    sentiment_score = result_bert[0]['score']

    # Print the results
    print(f"Sentiment Label: {sentiment_label}")
    print(f"Sentiment Score: {sentiment_score}")

if __name__ == "__main__":
    # Check if command-line argument is provided
    if len(sys.argv) != 2:
        print("Usage: python sentiment_analysis_script.py 'Your text goes here.'")
        sys.exit(1)

    # Get text from command-line argument
    text_to_analyze = sys.argv[1]

    # Run sentiment analysis
    analyze_sentiment(text_to_analyze)
