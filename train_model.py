import pandas as pd
from sklearn.model_selection import train_test_split
from sklearn.linear_model import LinearRegression
from sklearn.metrics import mean_squared_error
import joblib  # To save the trained model

# Load your dataset
df = pd.read_csv('csv/feedback_dataset.csv')

# Convert categorical variables (like skill_id) to numerical values using one-hot encoding
df = pd.get_dummies(df, columns=['skill_id'], prefix='skill')

# Separate features (X) and target variable (y)
X = df.drop('feedback', axis=1)
y = df['feedback']

# Split the dataset into training and testing sets
X_train, X_test, y_train, y_test = train_test_split(X, y, test_size=0.2, random_state=42)

# Initialize the model
model = LinearRegression()

# Train the model
model.fit(X_train, y_train)

# Make predictions on the test set
y_pred = model.predict(X_test)

# Evaluate the model on the test set
mse = mean_squared_error(y_test, y_pred)
print(f'Mean Squared Error on Test Set: {mse}')

# Print the coefficients (weights) associated with each feature
print('Coefficients:', model.coef_)

# Save the trained model
joblib.dump(model, 'dynamic_weights_model.joblib')
