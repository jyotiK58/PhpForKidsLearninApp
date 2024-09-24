import pandas as pd
from sklearn.cluster import KMeans
import json

# Load the data from the server or local storage
data = pd.read_csv('time_spent_data.csv')  # Ensure this file is updated with new entries

# Assume data has 'category' and 'time_spent' columns
X = data[['time_spent']].values

# K-Means clustering
kmeans = KMeans(n_clusters=3)  
kmeans.fit(X)

# Add cluster labels to your data
data['cluster'] = kmeans.labels_

# Save the clustering results to JSON
data.to_json('clustering_results.json', orient='records')

# Print clustering results for debugging
print(data[['category', 'time_spent', 'cluster']])
