from transformers import pipeline
import sys

try:
    # Load the sentiment analysis pipeline
    sentiment_analysis = pipeline("sentiment-analysis")

    # Read the comment from the command line arguments
    comment = sys.argv[1]

    # Perform sentiment analysis
    result = sentiment_analysis(comment)

    # Extract the positive score
    positive_score = result[0]['score']

    # Convert score to percentage
    positive_percent = positive_score * 100

    # Print the positive percentage without additional information
    print(positive_percent)

except Exception as e:
    print(f"Error: {e}")
