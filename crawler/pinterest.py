from pinata.client import PinterestPinata

# Retreive results for Women's shoes category.
pinata = PinterestPinata(email='<email>', password='<password>', username='<username>')
pinata.create_board(name='dataset', category='women shoes', description='dataset board')
