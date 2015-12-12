from ebaysdk import finding
from ebaysdk.finding import Connection as Finding

api = Finding(appid = "Sunybuff-abb6-4646-ab7c-a1d0c7af9945", config_file = None)

# Test Connection.
# print(response.dict()['paginationOutput']['pageNumber'])

filename = "data.txt"
file = open(filename, 'w')
file.seek(0)

# Retreive 10k results
for i in range(1,600):
	response = api.execute('findItemsAdvanced', {'keywords': 'women+shoes', 'paginationInput': {'entriesPerPage': '100', 'pageNumber': i}})
	list = response.dict()['searchResult']['item']
	for element in list:
		file.write(element['title'].encode('utf-8') + "\n")

''' 
Cannot fetch more than 10k results.
Error Message: {'ack': 'Failure', 'timestamp': '2015-12-11T06:59:33.876Z', 'errorMessage': {'error': {'category': 'Request', 'domain': 'Marketplace', 'severity': 'Error', 'message': 'Page Limit exceeded. Items can be fetched only for the first 100 pages..', 'subdomain': 'Search', 'parameter': '100', 'errorId': '61'}}, 'version': '1.13.0'}
'''