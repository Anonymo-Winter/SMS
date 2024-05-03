import pandas as pd
data = pd.read_csv("src/CSESTUDENTS.csv")
data.drop(['x','y'],axis=1,inplace=True)
print(data.head(5))
print("hello")