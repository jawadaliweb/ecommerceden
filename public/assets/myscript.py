import nltk

from nltk.sentiment.vader import SentimentIntensityAnalyzer

# Instantiate the sentiment analyzer
sid = SentimentIntensityAnalyzer()

# Define a function to analyze the sentiment of a given text
def analyze_sentiment(text):
    # Validate the input
    if not isinstance(text, str):
        raise TypeError('Input must be a string')
    
    # Use the sentiment analyzer to get a polarity score for the text
    # The polarity score is a dictionary with scores for positive, negative, and neutral sentiment
    polarity_scores = sid.polarity_scores(text)
    
    # Determine the sentiment label based on the polarity score
    if polarity_scores['compound'] >= 0.3:
        sentiment = 'very good 5 star'
    elif polarity_scores['compound'] >= 0.1:
        sentiment = 'good 4 star'
    elif polarity_scores['compound'] <= -0.3:
        sentiment = 'very bad 2 star'
    elif polarity_scores['compound'] <= -0.1:
        sentiment = 'bad 3 star'
    else:
        sentiment = 'neutral 1 star'
    
    # Format the sentiment label string
    sentiment_label = f'{sentiment}'
    
    # Return the sentiment label
    return sentiment_label

import sys
text = sys.argv[1]
sentiment = analyze_sentiment(text)
print(sentiment)
