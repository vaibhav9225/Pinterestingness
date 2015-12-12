import java.util.*;
import java.io.*;

class FeatureAggregator{

	private static HashMap<String, String> map = new HashMap<String, String>();
	
	public static void main(String[] args) throws Exception{
	
		// Build hash
		BufferedReader reader = new BufferedReader(new FileReader(new File("./data/features.txt")));
		String line;
		line = reader.readLine(); // Skip line 1
		line = reader.readLine(); // Skip line 2
		while((line = reader.readLine()) != null){
			String word = line.substring(0, line.indexOf(" ")).trim();
			String value = line.substring(line.indexOf(" ") + 1).trim();
			map.put(word, value);
		}
		reader.close();
		
		// Create training & testing set
		createSet("./data/training-data.txt", "./data/training-set.txt", 1, 4000, true);
		createSet("./data/testing-data.txt", "./data/testing-set.txt", -1, -1, false);
		
	}
	
	private static void createSet(String inputFile, String outputFile, int defaultLabel, int totalTitles, boolean isTraining) throws Exception{
		BufferedReader reader = new BufferedReader(new FileReader(new File(inputFile)));
		BufferedWriter writer = new BufferedWriter(new FileWriter(new File(outputFile)));
		String line;
		int count = 0;
		while((line = reader.readLine()) != null){
			String[] array = line.split(" ");
			double[] features = new double[10];
			for(int i=0; i<features.length; i++) features[i] = 0;
			for(String word : array){
				if(map.containsKey(word)){
					String[] featureArr = map.get(word).split(" ");
					for(int i=0; i<featureArr.length; i++){
						double value = Double.parseDouble(featureArr[i].trim());
						features[i] += value;
					}
				}
			}
			for(int i=0; i<features.length; i++) features[i] = features[i] / array.length;
			count++;
			int label = defaultLabel;
			if(isTraining && count > totalTitles/2) label *= -1;
			String output = label + " ";
			for(int i=0; i<features.length; i++) output += (i+1) + ":" + features[i] + " ";
			output = output.trim() + "\n";
			writer.write(output);
		}
		writer.close();
		reader.close();
	}
	
}
