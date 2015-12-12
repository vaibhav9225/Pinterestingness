import java.util.*;
import java.io.*;

class Filter{
	public static void main(String[] args) throws Exception{
		BufferedReader reader = new BufferedReader(new FileReader(new File("./data/testing-data.txt")));
		BufferedReader readerP = new BufferedReader(new FileReader(new File("./data/prediction.txt")));
		BufferedWriter writer = new BufferedWriter(new FileWriter(new File("./data/output.txt")));
		String line;
		while((line = reader.readLine()) != null){
			String prediction = readerP.readLine().trim();
			if(prediction.equals("1")){
				writer.write(line);
			}
		}
		writer.close();
		reader.close();
	}
}